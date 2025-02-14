import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private apiUrl = 'http://localhost:8000/api/sanpham/';

  constructor(private http: HttpClient) {}

  getProduct() {
    return this.http.get(this.apiUrl);
  }

  getOneProduct(id: string) {
    return this.http.get(this.apiUrl + id);
  }
}
