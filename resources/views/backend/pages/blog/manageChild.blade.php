<?php
if (!isset($dash))
    $dash = '-';
else
    $dash .= '-';
?>

@foreach($childDataTable as $child)
    @if($child->child)
        <tr>
            <td>{{$dash}} {{$child->title}}</td>
            <td>{{$child->category->name}}</td>

            <td>
                @if($child->files_field)
                    <img src="{{url($child->files_field['thumbnail'])}}"
                         alt="image not found" style="width: 80px;">
                @else
                    <span class="badge bg-danger"> No Image</span>
                @endif

            </td>
            <td style="width: 12%;">
                <a href="{{route('manage-blog.show',$child->id)}}"
                   class="btn btn-primary btn-sm" title="Show Blog">
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a href="{{route('manage-blog.edit',$child->id)}}"
                   class="btn btn-success btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>


        </tr>
            <?php $dash .= '-'; ?>
            <?php $dash = substr($dash, 0, -1); ?>
    @endif


    @include('backend.pages.blog.manageChild',['childDataTable' => $child->child])

@endforeach
