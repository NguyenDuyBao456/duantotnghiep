import { CommonModule, DecimalPipe } from '@angular/common';
import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-card-product',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './card-product.component.html',
  styleUrl: './card-product.component.css',
  providers: [],
})
export class CardProductComponent {
  @Input() product: any;

  constructor() {}
}
