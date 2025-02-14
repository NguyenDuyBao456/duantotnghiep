import { Component, OnInit } from '@angular/core';
import { CategoryService } from '../../services/category.service';
import { SubcategoriesService } from '../../services/subcategories.service';
import { concatMap, forkJoin, of } from 'rxjs';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css',
})
export class NavbarComponent implements OnInit {
  category: any;

  ngOnInit(): void {
    this.getCategory();
  }

  constructor(
    private categoryService: CategoryService,
    private subCategoriesService: SubcategoriesService
  ) {}

  getCategory() {
    forkJoin([
      this.categoryService.getCategory(),
      this.subCategoriesService.getSubCategories(),
    ])
      .pipe(
        concatMap(([category, subcategories]: any) => {
          return of(
            category.map((cate: any) => {
              return {
                ...cate,
                subcategories: subcategories.filter((subcate: any) => {
                  return subcate.categories_id === cate.id;
                }),
              };
            })
          );
        })
      )
      .subscribe((data: any) => {
        this.category = data;
      });
  }
}
