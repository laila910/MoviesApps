import { TestBed } from '@angular/core/testing';

import { IsnotloggedGuard } from './isnotlogged.guard';

describe('IsnotloggedGuard', () => {
  let guard: IsnotloggedGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(IsnotloggedGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
