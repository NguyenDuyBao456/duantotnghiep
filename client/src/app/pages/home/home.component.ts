import { CardProductComponent } from './../../components/card-product/card-product.component';
import { Component } from '@angular/core';
import { NavbarComponent } from '../../components/navbar/navbar.component';
import { FooterComponent } from '../../components/footer/footer.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CardProductComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
})
export class HomeComponent {}
