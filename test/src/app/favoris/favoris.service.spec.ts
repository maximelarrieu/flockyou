/* tslint:disable:no-unused-variable */

import { TestBed, async, inject } from '@angular/core/testing';
import { FavorisService } from './favoris.service';

describe('Service: Favoris', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [FavorisService]
    });
  });

  it('should ...', inject([FavorisService], (service: FavorisService) => {
    expect(service).toBeTruthy();
  }));
});
