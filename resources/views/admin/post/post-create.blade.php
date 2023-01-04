<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label>دسته بندی پست خود را انتخاب نمایید</label>
    @foreach($categories as $category)
        <ul>
            {{$category->title}}
        </ul>
    @endforeach
    <label> عنوان پست :</label>
    <input type="text" name="title" value="{{old('title')}}}" required>

    <label> محتوای پست :</label>
    <textarea name="content">{{old('content')}}</textarea>
    <label>تصویر پست شما:</label>
    <input type="file" name="pic">
    <label>تگ مورد نظر پست خود را انتخاب نمایید</label>
     @foreach($tags as $tag)
         <input type="checkbox" name="tags[]" value="{{old('tags')}}">
     @endforeach
    <button type="submit"> ثبت </button>
</form>
</body>
</html>
