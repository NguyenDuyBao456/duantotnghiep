import Swal from 'sweetalert2';
import { Component, OnInit } from '@angular/core';
import { OrderService } from '../../../services/order.service';
import { UserService } from '../../../services/user.service';
import { concatMap } from 'rxjs';

@Component({
  selector: 'app-order',
  standalone: true,
  imports: [],
  templateUrl: './order.component.html',
  styleUrl: './order.component.css',
})
export class OrderComponent implements OnInit {
  token: any = localStorage.getItem('token')
    ? JSON.parse(localStorage.getItem('token') || '')
    : '';
  user: any;

  orders: any;

  ngOnInit(): void {
    this.getOrder();
  }

  constructor(
    private orderService: OrderService,
    private userService: UserService
  ) {}

  getOrder() {
    this.userService
      .decoded(this.token)
      .pipe(
        concatMap((user: any) => {
          return this.orderService.getOrderByUser(user.id);
        })
      )
      .subscribe((data: any) => {
        this.orders = data;
      });
  }
}
