import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http'
import { Unirest as unirest } from 'unirest';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

// const unirest = require('unirest');
const req = unirest.get("https://api-football-v1.p.rapidapi.com/v2/fixtures/live");
req.query({
  "timezone": "Europe%2FLondon"
});
req.headers({
  "x-rapidapi-host": "api-football-v1.p.rapidapi.com",
	"x-rapidapi-key": "cb08921c4amshaf0ad5be2b81d0ep1c2bc9jsn69c33a23b5e0"
})

req.end(function (res) {
	if (res.error) throw new Error(res.error);

	console.log(res.body);
});

@Injectable({
  providedIn: 'root'
})

@Injectable()
export class LiveScore {
  public static fromJson(json: Object): LiveScore {
    return new LiveScore;
  }

  constructor() {}
}

export class LivesoccerService {

public req = ("https://api-football-v1.p.rapidapi.com/v2/fixtures/live");
constructor(private http: HttpClient) { }

getLiveScores(): Observable<LiveScore[]> {
  return this.http.get<LiveScore[]>(this.req).pipe(
    map(
      (data => data['fixtures'])
    )
  );
}

}
