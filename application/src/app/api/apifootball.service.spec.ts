/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { ApifootballService } from './apifootball.service';

describe('Service: Apifootball', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ApifootballService]
    });
  });

  it('should ...', inject([ApifootballService], (service: ApifootballService) => {
    expect(service).toBeTruthy();
  }));
});
