import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  create(data: any) {
    return this.http.post(this.apiUrl + '/api/order', data);
  }

  getOrderByUser(id: any) {
    return this.http.get(`${this.apiUrl}/api/get_order_by_user/${id}`);
  }

  getOrderByID(id: any) {
    return this.http.get(`${this.apiUrl}/api/get_order_by_id/${id}`);
  }

  getOrder() {
    return this.http.get(`${this.apiUrl}/api/order`);
  }
}
