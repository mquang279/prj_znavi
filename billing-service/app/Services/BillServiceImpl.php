<?php
namespace App\Services;


use App\Exceptions\ConFlictState;
use App\Exceptions\InventoryException;
use App\Inventory\InventoryClient;
use App\Models\Bill;
use App\Repositories\Interfaces\BillItemRepository;
use App\Repositories\Interfaces\BillRepository;
use App\Services\Interface\BillService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillServiceImpl implements BillService{
    protected $billRepo;
    protected $billItemRepo;
    private $inventoryClient;
    public function __construct(BillRepository $billRepo,
                                BillItemRepository $billItemRepo,
                                InventoryClient $inventoryClient)
    {
        $this->inventoryClient = $inventoryClient;
        $this->billRepo = $billRepo;
        $this->billItemRepo = $billItemRepo;
    }

    public function getBill(string $id)
    {
        $bill = $this->billRepo->findById($id);

        if (!$bill) {
            throw new \RuntimeException('BILL_NOT_FOUND');
        }

        return $bill;
    }

    public function getAll()
    {
        return $this->billRepo->findAll();
    }

    public function createBill(array $items,string $requesteId){
        return DB::transaction(function() use ($items,$requesteId){
            $bill = $this->billRepo->createBill([
                'id'=>(string) Str::uuid(),
                'status'=>'CREATED',
                'total_amount'=>0,
            ]);
            $total = 0;
            foreach($items as $item){
                $this->billItemRepo->create([
                    'bill_id'=>$bill->id,
                    'product_id'=>$item['productId'],
                    'qty'=>$item['qty'],
                    'unitPrice'=>$item['unitPrice'],
                ]);
                $total += $item['qty'] * $item['unitPrice'];
            }
            $bill->update(['total_amount'=>$total]);
            $bill->update(['status'=>'RESERVING']);
            try {
                $res = retry(3,function() use ($items,$bill,$requesteId){
                   return $this->inventoryClient->reserve(
                        [
                            'billId'=>$bill->id,
                            'ttlSeconds'=>600,
                            'items'=>$items,
                        ],$requesteId);
                },2000);
                $bill->update([
                    'status'=>'RESERVED',
                    'reservation_id'=>$res['reservationId'],
                ]);
            }catch (InventoryException $e){
                if($e->code === "INSUFFICIENT_STOCK"){
                    $bill->update(['status'=>'FAILED']);
                    throw $e;
                }
            }
            return $this->billRepo->findById($bill->id);
        });
    }

    public function confirmBill(string $id,string $requesteId){
        return DB::transaction(function() use ($id,$requesteId){
            $bill = $this->billRepo->findById($id);
            if($bill->status != 'RESERVED'){
                throw new ConFlictState('BILL_NOT_RESERVED',
                    [
                        'reservationId' => $bill->reservation_id,
                        'currentState' => $bill->status,
                        'allowedStates' => ['RESERVED'],
                        'action' => 'COMMIT',
                    ]);
            }

            if(empty($bill->reservation_id)){
                throw new ConFlictState('NO_RESERVATION_ID  ', []);
            }

            $bill->update(['status'=>'CONFIRMING']);
            $res= retry(3,function() use ($requesteId){
                return $this->inventoryClient->commit($requesteId);
            },2000);
            $bill->update(['status'=>$res['status']]);
        });
    }
}
