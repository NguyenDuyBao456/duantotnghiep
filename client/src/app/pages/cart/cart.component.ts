import { Component, OnInit } from '@angular/core';
import { CartService } from '../../services/cart.service';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { PaymentService } from '../../services/payment.service';
import {
  FormControl,
  FormGroup,
  FormsModule,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { UserService } from '../../services/user.service';
import { ShipService } from '../../services/ship.service';

@Component({
  selector: 'app-cart',
  standalone: true,
  imports: [CommonModule, FormsModule, ReactiveFormsModule],
  templateUrl: './cart.component.html',
  styleUrl: './cart.component.css',
})
export class CartComponent implements OnInit {
  cart: any;
  total: number = 0;

  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';
  user: any;

  ships: any;

  form: FormGroup = new FormGroup({
    name: new FormControl('', [Validators.required]),
    address: new FormControl('', [Validators.required]),
    phone: new FormControl('', [
      Validators.required,
      Validators.pattern(/^(09|03|08|07|05)\d{8}$/),
    ]),
    ship: new FormControl('', [Validators.required]),
  });

  ngOnInit(): void {
    this.getCart();
    this.getTotal();
    this.getUser();
    this.getShip();
  }

  constructor(
    private cartService: CartService,
    private paymentService: PaymentService,
    private userService: UserService,
    private shipService: ShipService
  ) {}

  getShip() {
    this.shipService.getShip().subscribe((data: any) => {
      this.ships = data;
    });
  }

  getUser() {
    this.userService.decoded(this.token).subscribe((data: any) => {
      this.user = data;

      if (localStorage.getItem('cart')) {
        this.cart = JSON.parse(localStorage.getItem('cart') || '').filter(
          (item: any) => {
            return item.user === this.user.id;
          }
        );

        this.total = this.cart.reduce(
          (init: any, item: any) => item.details.price * item.qty + init,
          0
        );
      } else {
        this.cart = [];
      }
    });
  }

  getCart() {}

  UpdateQty(qty: any, index: number) {
    this.cart[index].qty = +qty.value;

    this.cartService.setCart(this.cart);
    this.getTotal();
  }

  deleteCart(index: number) {
    this.cart = JSON.parse(localStorage.getItem('cart') || '');

    this.cart.splice(index, 1);
    this.cartService.setCart(this.cart);
    this.getTotal();
  }

  getTotal() {}

  setUserOrder() {
    const { name, ship, phone, address } = this.form.value;
    const date = new Date();

    localStorage.setItem(
      'user_order',
      JSON.stringify({
        id_ptvc: +ship,
        id_user: this.user.id,
        status: 'Đang xử lý',
        datetime: `${
          date.getDate() < 10 ? '0' + date.getDate() : date.getDate()
        }/${
          date.getMonth() + 1 < 10
            ? '0' + (date.getMonth() + 1)
            : date.getMonth()
        }/${date.getFullYear()}`,
        name,
        phone,
        address,
        amount: this.total,
      })
    );
  }

  zalopay() {
    if (!this.form.valid) {
      Swal.fire({
        text: 'Vui lòng điền đầy đủ thông tin trước khi thanh toán',
        icon: 'warning',
        allowOutsideClick: false,
      }).then(({ isConfirmed }) => {
        if (isConfirmed) Swal.close();
      });
      return;
    }

    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    const formData: any = new URLSearchParams();
    formData.append('amount', this.total);

    this.paymentService.zalopay(formData.toString()).subscribe((data: any) => {
      if (data.returncode === 1) {
        this.setUserOrder();
        location.href = data.orderurl;
      }
    });
  }

  vnpay() {
    if (!this.form.valid) {
      Swal.fire({
        text: 'Vui lòng điền đầy đủ thông tin trước khi thanh toán',
        icon: 'warning',
        allowOutsideClick: false,
      }).then(({ isConfirmed }) => {
        if (isConfirmed) Swal.close();
      });
      return;
    }

    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    const formData: any = new URLSearchParams();
    formData.append('amount', this.total);

    this.paymentService.vnpay(formData.toString()).subscribe((data: any) => {
      this.setUserOrder();
      location.href = data;
    });
  }

  momo() {
    if (!this.form.valid) {
      Swal.fire({
        text: 'Vui lòng điền đầy đủ thông tin trước khi thanh toán',
        icon: 'warning',
        allowOutsideClick: false,
      }).then(({ isConfirmed }) => {
        if (isConfirmed) Swal.close();
      });
      return;
    }

    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    const formData: any = new URLSearchParams();
    formData.append('amount', this.total);

    this.paymentService.momo(formData.toString()).subscribe((data: any) => {
      this.setUserOrder();
      location.href = data;
    });
  }

  onSubmit() {}
}
