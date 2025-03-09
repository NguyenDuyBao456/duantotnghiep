import { Component, OnInit } from '@angular/core';
import { OrderService } from '../../services/order.service';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-orderdetails',
  standalone: true,
  imports: [],
  templateUrl: './orderdetails.component.html',
  styleUrl: './orderdetails.component.css',
})
export class OrderdetailsComponent implements OnInit {
  order: any;

  ngOnInit(): void {
    this.getData();
  }

  constructor(
    private orderService: OrderService,
    private route: ActivatedRoute,
    private productService: ProductService
  ) {}

  getData() {
    this.route.params.subscribe((params: any) => {
      this.orderService.getOrderByID(params.id).subscribe((data: any) => {
        this.order = data;
        console.log(this.order);
      });
    });
  }
}
