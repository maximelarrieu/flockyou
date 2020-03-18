import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class Size {

  public static fromJson(json: Object): Size {
    return new Size(
      json['name']
    );
  }

  constructor(public size: string) {
  }
}

@Injectable()
export class HomeService {

constructor(protected http: HttpClient) {}
  
  private sizesUrl = 'https://localhost:8000/api/sizes?page=1';  // URL to web api
  
  public getSizes(): Observable<Size[]> {
    return this.http.get<Size[]>(this.sizesUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    );
  }

}
