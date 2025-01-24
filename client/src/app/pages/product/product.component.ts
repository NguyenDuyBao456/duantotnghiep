import { Component } from '@angular/core';
import { CardProductComponent } from '../../components/card-product/card-product.component';

@Component({
  selector: 'app-product',
  standalone: true,
  imports: [CardProductComponent],
  templateUrl: './product.component.html',
  styleUrl: './product.component.css',
})
export class ProductComponent {}
