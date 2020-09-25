<div align="center">

# EASY EXCEL

<p>
    <a href="https://github.com/jqhph/easy-excel/blob/master/LICENSE"><img src="https://img.shields.io/badge/license-MIT-7389D8.svg?style=flat" ></a>
     <a href="https://styleci.io/repos/215738797">
        <img src="https://github.styleci.io/repos/215738797/shield" alt="StyleCI">
    </a>
    <a href="https://github.com/jqhph/easy-excel/releases" ><img src="https://img.shields.io/github/release/jqhph/easy-excel.svg?color=4099DE" /></a> 
    <a href="https://packagist.org/packages/dcat/easy-excel"><img src="https://img.shields.io/packagist/dt/dcat/easy-excel.svg?color=" /></a> 
    <a><img src="https://img.shields.io/badge/php-7.1+-59a9f8.svg?style=flat" /></a> 
</p>

</div>

`Easy Excel`是一个基于 <a href="https://github.com/box/spout" target="_blank">box/spout</a> 封装的Excel读写工具，可以帮助开发者更快速更轻松地读写Excel文件，
并且无论读取多大的文件只需占用极少的内存。

> 由于`box/spout`只支持读写`xlsx`、`csv`、`ods`等类型文件，所以本项目目前也仅支持读写这三种类型的文件。


## 文档

[文档](https://jqhph.github.io/easyexcel/)

## 环境

- PHP >= 7.1
- PHP extension php_zip
- PHP extension php_xmlreader
- box/spout >= 3.0
- league/flysystem >= 1.0


## 安装

```bash
composer require dcat/easy-excel
```

### 快速开始

#### 导出


下载
```php
use Dcat\EasyExcel\Excel;

$array = [
    ['id' => 1, 'name' => 'Brakus', 'email' => 'treutel@eg.com', 'created_at' => '...'], 
    ...
];

$headings = ['id' => 'ID', 'name' => '名称', 'email' => '邮箱'];

// xlsx
Excel::export($array)->headings($headings)->download('users.xlsx');

// csv
Excel::export($array)->headings($headings)->download('users.csv');

// ods
Excel::export($array)->headings($headings)->download('users.ods');
```

保存
```php
use Dcat\EasyExcel\Excel;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

$array = [...];

// 保存到当前服务器
Excel::export($array)->store('/tmp/users.xlsx');


// 使用 filesystem
$adapter = new Local(__DIR__);

$filesystem = new Filesystem($adapter);

Excel::export($array)->disk($filesystem)->store('users.xlsx');
```

获取文件内容
```php
use Dcat\EasyExcel\Excel;

$array = [...];

$xlsxContents = Excel::xlsx($array)->raw();

$csvContents = Excel::csv($array)->raw();

$odsContents = Excel::ods($array)->raw();
```
更多导出功能请参考[文档](https://jqhph.github.io/easy-excel/docs/master/export.html)。

#### 导入


读取所有表格数据
```php
use Dcat\EasyExcel\Excel;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

$headings = ['id', 'name', 'email'];

// 导入xlsx
$allSheets = Excel::import('/tmp/users.xlsx')->headings($headings)->toArray();


// 使用filesystem
$adapter = new Local(__DIR__);

$filesystem = new Filesystem($adapter);

$allSheets = Excel::import('users.xlsx')->disk($filesystem)->headings($headings)->toArray();


print_r($allSheets); // ['Sheet1' => [['id' => 1, 'name' => 'Brakus', 'email' => 'treutel@eg.com', 'created_at' => '...']]]
```

遍历表格
```php
use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Contracts\Sheet as SheetInterface;
use Dcat\EasyExcel\Support\SheetCollection;

// 导入xlsx
Excel::import('/tmp/users.xlsx')->each(function (SheetInterface $sheet) {
    // 获取表格名称，如果是csv文件，则此方法返回空字符串
    $sheetName = $sheet->getName();

    // 表格序号，从 0 开始
    $sheetIndex = $sheet->getIndex();
    
    // 是否是最后一次保存前打开的表格
    $isActive = $sheet->isActive();
    
    // 分块处理表格数据
    $sheet->chunk(100, function (SheetCollection $collection) {
        $chunkArray = $collection->toArray();
        
        print_r($chunkArray); // [['id' => 1, 'name' => 'Brakus', 'email' => 'treutel@eg.com', 'created_at' => '...']]
    });
    
});
```

获取指定表格内容
```php
use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\SheetCollection;

// 获取第一个表格内容
$firstSheet = Excel::import('/tmp/users.xlsx')->first()->toArray();


// 获取最后一次保存前打开的表格内容
$activeSheet = Excel::import('/tmp/users.xlsx')->active()->toArray();


// 获取指定名称或序号的表格内容
$sheet = Excel::import('/tmp/users.xlsx')->sheet('Sheet1')->toArray();
$sheet = Excel::import('/tmp/users.xlsx')->sheet(0)->toArray();


// 分块处理表格内容
Excel::import('/tmp/users.xlsx')
    ->first()
    ->chunk(1000, function (SheetCollection $collection) {
        $collection = $collection->keyBy('id');
    });
```

更多导入功能请参考[文档](https://jqhph.github.io/easy-excel/docs/master/import.html)。


## License
[The MIT License (MIT)](LICENSE).
