import './input.css'
import ReactDOM from "react-dom/client";
import { BrowserRouter, Route, Routes } from 'react-router';
import HomePage from './pages/HomePage.tsx';
import DefaultLayout from './components/layout/DefaultLayout.tsx';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import LoginPage from './pages/LoginPage.tsx';
import RegisterPage from './pages/RegisterPage.tsx';

const queryClient = new QueryClient();

const root: HTMLElement | null = document.getElementById("root");

if (!root) throw new Error("Root element not found");


ReactDOM.createRoot(root).render(
  <QueryClientProvider client={queryClient}>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={
          <DefaultLayout>
            <HomePage />
          </DefaultLayout>
        } />

        <Route path='/login' element={
          <LoginPage />
        } 
        />

        <Route path='/register' element={
          <RegisterPage/> 
        }/>
      </Routes>
    </BrowserRouter>
  </QueryClientProvider>
);
