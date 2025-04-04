import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  private apiUrl = 'http://localhost:8000/api/order/';

  constructor(private http: HttpClient) {}

  create(data: any) {
    return this.http.post(this.apiUrl, data);
  }

  getOrderByUser(id: any) {
    return this.http.get(`http://localhost:8000/api/get_order_by_user/${id}`);
  }

  getOrderByID(id: any) {
    return this.http.get(`http://localhost:8000/api/get_order_by_id/${id}`);
  }

  getOrder() {
    return this.http.get('http://localhost:8000/api/order');
  }
}
