import { authGuard } from './guards/auth.guard';
import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { ProductComponent } from './pages/product/product.component';
import { LoginComponent } from './pages/login/login.component';
import { RegisterComponent } from './pages/register/register.component';
import { DetailsComponent } from './pages/details/details.component';
import { CartComponent } from './pages/cart/cart.component';
import { NotfoundComponent } from './pages/notfound/notfound.component';
import { ProfileComponent } from './pages/profile/profile.component';
import { InfoComponent } from './pages/profile/info/info.component';
import { guestGuard } from './guards/guest.guard';
import { ThankComponent } from './pages/thank/thank.component';
import { OrderComponent } from './pages/profile/order/order.component';
import { OrderdetailsComponent } from './pages/orderdetails/orderdetails.component';
import { FavoriteComponent } from './pages/favorite/favorite.component';
import { PasswordComponent } from './pages/profile/password/password.component';
import { SearchComponent } from './pages/search/search.component';

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
    canActivate: [guestGuard],
  },
  {
    path: 'register',
    component: RegisterComponent,
    canActivate: [guestGuard],
  },
  {
    path: 'details',
    component: DetailsComponent,
  },
  {
    path: 'cart',
    component: CartComponent,
    canActivate: [authGuard],
  },
  {
    path: 'details/:id',
    component: DetailsComponent,
  },
  {
    path: '404',
    component: NotfoundComponent,
  },
  {
    path: 'profile',
    component: ProfileComponent,
    canActivate: [authGuard],
    children: [
      {
        path: 'info',
        component: InfoComponent,
      },
      {
        path: '',
        redirectTo: 'info',
        pathMatch: 'full',
      },
      {
        path: 'order',
        component: OrderComponent,
      },
      {
        path: 'password',
        component: PasswordComponent,
      },
    ],
  },
  {
    path: 'thank',
    component: ThankComponent,
  },
  {
    path: 'orderdetails/:id',
    component: OrderdetailsComponent,
  },
  {
    path: 'favorite',
    component: FavoriteComponent,
    canActivate: [authGuard],
  },
  {
    path: 'search/:keyword',
    component: SearchComponent,
  },
];
