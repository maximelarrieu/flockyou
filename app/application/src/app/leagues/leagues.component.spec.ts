import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { LeaguesComponent } from './leagues.component';

describe('LeaguesComponent', () => {
  let component: LeaguesComponent;
  let fixture: ComponentFixture<LeaguesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LeaguesComponent ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(LeaguesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
