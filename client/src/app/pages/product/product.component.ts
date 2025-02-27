import {
  AfterViewChecked,
  AfterViewInit,
  ChangeDetectorRef,
  Component,
  ElementRef,
  OnInit,
  QueryList,
  viewChildren,
  ViewChildren,
} from '@angular/core';
import { CardProductComponent } from '../../components/card-product/card-product.component';
import { ProductService } from '../../services/product.service';
import {
  ActivatedRoute,
  Router,
  RouterLink,
  RouterLinkActive,
} from '@angular/router';
import { concatMap, forkJoin, of } from 'rxjs';
import { SubcategoriesService } from '../../services/subcategories.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-product',
  standalone: true,
  imports: [CardProductComponent, RouterLink, RouterLinkActive],
  templateUrl: './product.component.html',
  styleUrl: './product.component.css',
})
export class ProductComponent
  implements OnInit, AfterViewInit, AfterViewChecked
{
  products: any;
  subcategory: any;
  index: number = 8;
  check: boolean = true;
  total: number = 0;

  isClickFilterPrice: any[] = [];

  @ViewChildren('price') priceElements!: QueryList<ElementRef>;
  @ViewChildren('category') categoryElements!: QueryList<ElementRef>;

  activePrice: any = localStorage.getItem('activePrice');
  activeCategory: any = localStorage.getItem('activeCategory');

  constructor(
    private productService: ProductService,
    private route: ActivatedRoute,
    private subCategoriesService: SubcategoriesService,
    private router: Router,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit(): void {
    this.getProduct();
    this.getSubCategory();
  }

  ngAfterViewInit(): void {}

  ngAfterViewChecked(): void {
    this.setActivePrice(this.activePrice);
    this.setActiveCategory(this.activeCategory);
  }

  viewMore() {
    this.index += 4;
    this.getProduct();
  }

  getProduct() {
    Swal.fire({
      didOpen: () => {
        Swal.showLoading();
      },
      allowOutsideClick: false,
    });

    this.route.queryParams
      .pipe(
        concatMap((queryParams: any) => {
          return this.productService.getProduct().pipe(
            concatMap((products: any) => {
              if (
                queryParams.min &&
                queryParams.max &&
                !queryParams.subcategories
              ) {
                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category &&
                    product.price >= queryParams.min &&
                    product.price <= queryParams.max
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              } else if (
                queryParams.subcategories &&
                !queryParams.min &&
                !queryParams.max
              ) {
                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category &&
                    product.subcategories_id == queryParams.subcategories
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              } else if (
                queryParams.min &&
                queryParams.max &&
                queryParams.subcategories
              ) {
                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category &&
                    product.price >= queryParams.min &&
                    product.price <= queryParams.max &&
                    product.subcategories_id == queryParams.subcategories
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              } else {
                const data = products.filter(
                  (product: any) =>
                    product.categories_id == queryParams.category
                );
                this.total = data.length;
                return of(data.slice(0, this.index));
              }
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.products = data;
        Swal.close();

        if (this.total === data.length) {
          this.check = false;
        }
      });
  }

  getSubCategory() {
    this.route.queryParams
      .pipe(
        concatMap((queryParams: any) => {
          return this.subCategoriesService.getSubCategories().pipe(
            concatMap((subcategories: any) => {
              return of(
                subcategories.filter(
                  (subcate: any) =>
                    subcate.categories_id == queryParams.category
                )
              );
            })
          );
        })
      )
      .subscribe((data: any) => (this.subcategory = data));
  }

  filterPrice(min: number, max: number, url: string) {
    if (this.router.url.includes(`&min=${min}&max=${max}`)) {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { min: null, max: null },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          localStorage.removeItem('activePrice');
          window.location.reload();
        });
    } else {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { min, max },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          this.getProduct();
          this.setActivePrice(url);
        });
    }
  }

  filterSubCategory(subcategories: number, url: string) {
    if (this.router.url.includes(`&subcategories=${subcategories}`)) {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { subcategories: null },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          localStorage.removeItem('activeCategory');
          window.location.reload();
        });
    } else {
      this.router
        .navigate([], {
          relativeTo: this.router.routerState.root,
          queryParams: { subcategories },
          queryParamsHandling: 'merge',
        })
        .then(() => {
          this.getProduct();
          this.setActiveCategory(url);
        });
    }
  }

  setActivePrice(url: string) {
    localStorage.setItem('activePrice', url);

    this.priceElements.forEach((element: ElementRef) => {
      if (location.href.includes(element.nativeElement.getAttribute('fr'))) {
        console.log('Price');

        element.nativeElement.classList.add('color-bg', 'text-ligt');
      } else {
        element.nativeElement.classList.remove('color-bg', 'text-light');
      }
    });
  }

  setActiveCategory(url: string) {
    localStorage.setItem('activeCategory', url);

    this.categoryElements.forEach((element: ElementRef) => {
      if (location.href.includes(element.nativeElement.getAttribute('fc'))) {
        console.log('Category');

        element.nativeElement.classList.add('color-bg', 'text-ligt');
      } else {
        element.nativeElement.classList.remove('color-bg', 'text-light');
      }
    });
  }
}
