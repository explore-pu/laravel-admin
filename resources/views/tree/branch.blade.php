@if($branch['group'] == $group)
    <li class="dd-item" data-id="{{ $branch[$keyName] }}">
        <div class="dd-handle">
            {!! $branchCallback($branch) !!}
            {!! $actions->setRow($branch)->display($actionsCallback) !!}
        </div>
        @if(isset($branch['children']))
            <ol class="dd-list">
                @foreach($branch['children'] as $branch)
                    @include($branchView,  $branch)
                @endforeach
            </ol>
        @endif
    </li>
@endif
