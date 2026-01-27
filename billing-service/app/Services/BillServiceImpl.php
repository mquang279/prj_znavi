<?php
namespace App\Services;


use App\Repositories\Interfaces\BillItemRepository;
use App\Repositories\Interfaces\BillRepository;
use App\Services\Interface\BillService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillServiceImpl implements BillService{
    protected $billRepo;
    protected $billItemRepo;
    public function __construct(BillRepository $billRepo,
                                BillItemRepository $billItemRepo)
    {
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

    public function createBill(array $items){
        return DB::transaction(function() use ($items){
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
            return $this->billRepo->findById($bill->id);
        });
    }
}
