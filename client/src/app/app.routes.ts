import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { ProductComponent } from './pages/product/product.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { DetailsComponent } from './pages/details/details.component';
import { CartComponent } from './pages/cart/cart.component';
import { NotfoundComponent } from './pages/notfound/notfound.component';

export const routes: Routes = [
  {
    path: '',
    component: HomeComponent,
  },
  {
    path: 'product',
    component: ProductComponent,
  },
  {
    path: 'login',
    component: LoginComponent,
  },
  {
    path: 'register',
    component: RegisterComponent,
  },
  {
    path: 'details',
    component: DetailsComponent,
  },
  {
    path: 'cart',
    component: CartComponent,
  },
  {
    path: 'details/:id',
    component: DetailsComponent,
  },
  {
    path: '404',
    component: NotfoundComponent,
  },
];
