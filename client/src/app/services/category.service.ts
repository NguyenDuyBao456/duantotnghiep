import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class CategoryService {
  private apiUrl = 'http://localhost:8000/api/danhmuc/';

  constructor(private http: HttpClient) {}

  getCategory() {
    return this.http.get(this.apiUrl);
  }
}
