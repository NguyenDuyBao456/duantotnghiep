import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class SubcategoriesService {
  private apiUrl = 'http://localhost:8000/api/danhmuccon/';

  constructor(private http: HttpClient) {}

  getSubCategories() {
    return this.http.get(this.apiUrl);
  }
}
