<?php

require_once '../src/Services/CategoryDisplayService.php';
require_once '../src/Entities/CategoryEntity.php';

use PHPUnit\Framework\TestCase;

class TestCategoryDisplayService extends TestCase
{
    public function testDisplayCategory_Success() {
        $categoryMock = $this->createMock(CategoryEntity::class);
        $categoryMock->method('getName')->willReturn('test');
        $categoryMock->method('getStockTotal')->willReturn(100);
        $result = CategoryDisplayService::displayCategory($categoryMock);
        $expectedResult =
'<div class="bg-slate-100 p-5">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl">test</h3>
            <span class="bg-teal-500 text-2xl px-2 py-1 rounded">100</span>
        </div>
        <a href="products.php?id=0" class="inline-block bg-blue-600 px-3 py-2 rounded text-white">More >></a>
    </div>';
        $this->assertSame($result, $expectedResult);
    }

    public function testDisplayCategory_Malformed()
    {
        $this->expectException(TypeError::class);
        CategoryDisplayService::displayCategory('dave');
    }
}