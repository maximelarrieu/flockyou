import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class League {

  public static fromJson(json: Object): League {
    return new League(
      json['name'],
      json['image']
    );
  }
  constructor(public name: string,
              public image: string) {
  }
}

@Injectable()
export class LeaguesService {

  constructor(protected http: HttpClient) {}
  
  private leaguesUrl = 'https://localhost:8000/api/leagues?page=1';  // URL to web api
  
  public getLeagues(): Observable<League[]> {
    return this.http.get<League[]>(this.leaguesUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    );
  }
  
    // private extractData(res: Response) {
    //   let body = <League[]>res.json();
    //   return body || [];
    // }
};
