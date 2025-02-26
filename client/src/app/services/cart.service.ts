import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CartService {
  private cartSource = new BehaviorSubject<any>(
    JSON.parse(localStorage.getItem('cart') || '{}')
  );
  currentCart = this.cartSource.asObservable();

  constructor() {}

  setCart(data: any) {
    localStorage.setItem('cart', JSON.stringify(data));
    this.cartSource.next(data);
  }

  getCart() {
    return localStorage.getItem('cart');
  }

  changeCart() {
    this.cartSource.next(this.getCart());
  }
}
