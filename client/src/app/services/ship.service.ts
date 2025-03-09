import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class ShipService {
  constructor(private http: HttpClient) {}

  getShip() {
    return this.http.get('http://localhost:8000/api/ship');
  }
}
