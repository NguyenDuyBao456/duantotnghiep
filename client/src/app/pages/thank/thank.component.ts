import { Component, OnInit } from '@angular/core';
import { PaymentService } from '../../services/payment.service';
import { ActivatedRoute } from '@angular/router';
import { OrderService } from '../../services/order.service';
import { UserService } from '../../services/user.service';
import { ShipService } from '../../services/ship.service';

@Component({
  selector: 'app-thank',
  standalone: true,
  imports: [],
  templateUrl: './thank.component.html',
  styleUrl: './thank.component.css',
})
export class ThankComponent implements OnInit {
  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';
  user: any;

  ngOnInit(): void {
    this.checkout();
  }

  constructor(
    private paymentService: PaymentService,
    private route: ActivatedRoute,
    private orderService: OrderService,
    private userService: UserService,
    private shipService: ShipService
  ) {}

  createOrder(pay: number) {
    this.userService.decoded(this.token).subscribe((data: any) => {
      const user_order = JSON.parse(localStorage.getItem('user_order') || '');
      const cart = JSON.parse(localStorage.getItem('cart') || '').filter(
        (item: any) => {
          return item.user === data.id;
        }
      );

      const order = {
        ...user_order,
        id_pttt: pay,
        item: cart.map((c: any) => {
          return {
            id_product: c.details.id,
            price: c.details.price,
            quantity: c.qty,
          };
        }),
      };

      this.orderService.create(order).subscribe((data: any) => {
        console.log(data);
        localStorage.removeItem('cart');
        localStorage.removeItem('user_order');
      });
    });
  }

  checkout() {
    this.route.queryParams.subscribe((queryParams: any) => {
      if (queryParams.pay === 'vnpay') {
        this.paymentService.vnpayReturn(queryParams).subscribe((data: any) => {
          this.createOrder(2);
        });
      } else if (queryParams.pay === 'zalopay') {
        const formData: any = new URLSearchParams();
        formData.append('apptransid', queryParams.apptransid);

        this.paymentService.zalopayReturn(formData).subscribe((data: any) => {
          console.log(data);

          this.createOrder(3);
        });
      }
    });
  }
}
