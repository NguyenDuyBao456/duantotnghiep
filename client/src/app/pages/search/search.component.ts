import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductService } from '../../services/product.service';

@Component({
  selector: 'app-search',
  standalone: true,
  imports: [],
  templateUrl: './search.component.html',
  styleUrl: './search.component.css',
})
export class SearchComponent implements OnInit {
  keyword: string = '';
  product: any;

  ngOnInit(): void {
    this.getSearch();
  }

  constructor(
    private route: ActivatedRoute,
    private productService: ProductService
  ) {}

  getSearch() {
    this.keyword = this.route.snapshot.params['keyword'];

    this.productService.getProduct().subscribe((data: any) => {
      this.product = data.filter((item: any) => {
        return item.name
          .toLocaleLowerCase()
          .includes(this.keyword.toLocaleLowerCase());
      });

      console.log(this.product);
    });
  }
}
