/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { LivesoccerService } from './livesoccer.service';

describe('Service: Livesoccer', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [LivesoccerService]
    });
  });

  it('should ...', inject([LivesoccerService], (service: LivesoccerService) => {
    expect(service).toBeTruthy();
  }));
});
