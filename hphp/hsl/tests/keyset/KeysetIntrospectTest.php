<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

use namespace HH\Lib\Keyset;
use function HH\__Private\MiniTest\expect;
use type HH\__Private\MiniTest\{DataProvider, HackTest};

final class KeysetIntrospectTest extends HackTest {

  public static function provideTestEqual(): varray<mixed> {
    return varray[
      tuple(
        keyset[1, 2, 3],
        keyset[1, 2, 3],
        true,
      ),
      tuple(
        keyset[1, 2, 3],
        keyset[1, 2],
        false,
      ),
      tuple(
        keyset[1, 2, 3],
        keyset[1, 2, 4],
        false,
      ),
      tuple(
        keyset[1, 2, 3],
        keyset[1, 2, 3, 4],
        false,
      ),
      tuple(
        keyset[1, 2, 3],
        keyset[1, 2, '3'],
        false,
      ),
      tuple(
        keyset[1, 2, 3],
        keyset[1, 3, 2],
        true,
      ),
    ];
  }

  <<DataProvider('provideTestEqual')>>
  public function testEqual<Tv as arraykey>(
    keyset<Tv> $keyset1,
    keyset<Tv> $keyset2,
    bool $expected,
  ): void {
    expect(Keyset\equal($keyset1, $keyset2))->toEqual($expected);
  }
}
