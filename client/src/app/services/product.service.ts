import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  getProduct() {
    return this.http.get(this.apiUrl + '/api/sanpham');
  }

  getOneProduct(id: string) {
    return this.http.get(this.apiUrl + '/api/sanpham/' + id);
  }
}
