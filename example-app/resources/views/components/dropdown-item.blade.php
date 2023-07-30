<?php 
   
    if(!isset($active)){
        $active=false;
    }
    echo $active;

   
    $classes = 'ml-2 text-sm font-medium text-gray-900 dark:text-gray-300';
    if($active){
        $classes.='bg-blue-500 text-white';
    }
?>
<li>
    <div class="flex items-center">
        <a  href="/category?id={{$category->id}}"for="default-radio-1" class="{{$classes}}">
             <input id="default-radio-1" 
             type="radio" 
             value="" 
             name="default-radio" 
             class="{{$classes}}">
       {{$category->name}}</a>
    </div>
  </li>
  {{-- class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" --}}