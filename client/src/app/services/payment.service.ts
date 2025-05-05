import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class PaymentService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  zalopay(data: any) {
    return this.http.post(`${this.apiUrl}/api/zalopay`, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }

  vnpay(data: any) {
    return this.http.post(`${this.apiUrl}/api/vnpay`, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }

  momo(data: any) {
    return this.http.post(`${this.apiUrl}/api/momo`, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }

  vnpayReturn(data: any) {
    return this.http.post(`${this.apiUrl}/api/vnpay-return`, data);
  }

  zalopayReturn(data: any) {
    return this.http.post(`${this.apiUrl}/api/zalopay-return`, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });
  }
}
