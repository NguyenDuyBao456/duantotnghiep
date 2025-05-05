import { CardProductComponent } from './../../components/card-product/card-product.component';
import {
  AfterViewInit,
  Component,
  ElementRef,
  OnInit,
  QueryList,
  ViewChildren,
  viewChildren,
} from '@angular/core';
import { NavbarComponent } from '../../components/navbar/navbar.component';
import { FooterComponent } from '../../components/footer/footer.component';
import { ProductService } from '../../services/product.service';
import { CategoryService } from '../../services/category.service';
import { concatMap, forkJoin, of } from 'rxjs';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CardProductComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
})
export class HomeComponent implements OnInit, AfterViewInit {
  @ViewChildren('section') sectionElement!: QueryList<ElementRef>;

  products: any;
  outstanding: any;

  constructor(
    private productService: ProductService,
    private categoryService: CategoryService
  ) {}

  ngOnInit(): void {
    this.getProduct();
    this.getOutStanding();
    this.isLoading();
  }

  ngAfterViewInit(): void {
    this.onScroll();
  }

  async isLoading() {
    Swal.fire({
      title: 'Loading...',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    // Chờ cả API và window.load hoàn thành
    await Promise.all([
      this.productService.getProduct().toPromise(),
      this.categoryService.getCategory().toPromise(),
      new Promise((resolve) => window.addEventListener('load', resolve)),
    ]);

    Swal.close();
  }

  getProduct() {
    forkJoin([
      this.categoryService.getCategory(),
      this.productService.getProduct(),
    ])
      .pipe(
        concatMap(([categories, products]: [category: any, product: any]) => {
          return of(
            categories.map((cate: any) => {
              return {
                ...cate,
                products: products
                  .filter((prod: any) => prod.categories_id === cate.id)
                  .slice(0, 8),
              };
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.products = data;

        console.log(this.products);
      });
  }

  getOutStanding() {
    this.productService.getProduct().subscribe((data: any) => {
      this.outstanding = data.reverse().slice(0, 4);
    });
  }

  onScroll() {
    window.addEventListener('scroll', () => {
      const scrollTop = window.scrollY || document.documentElement.scrollTop; // Vị trí cuộn hiện tại

      this.sectionElement.forEach((element: ElementRef) => {
        const rect = element.nativeElement.getBoundingClientRect(); // Lấy vị trí của phần tử
        console.log(rect, element.nativeElement, window.innerHeight, scrollTop);

        if (rect.top - 100 < window.innerHeight) {
          element.nativeElement.classList.add('fade-out');
        }
      });
    });
  }

  search(keyword: any) {
    location.href = `/search/${keyword.value}`;
  }
}
