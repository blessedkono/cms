<hr>
<h4>@lang('menu.workflow')</h4>
<div class="row">
    @foreach($wf_groups as $wf_group)
        @foreach($wf_group->modules as $module)
            <div class="col-sm-6">
                <h5><b>{{ $module->name }}</b></h5>
                <ul style="list-style: none">
                    @foreach($module->definitions as $definition)
                        <li><input type="checkbox" name="definition[]" value="{{ $definition->id }}" id="{{ $definition->id  }}" />
                            <label for="{{ $definition->id  }}">&nbsp;&nbsp;&nbsp;Level&nbsp;&nbsp;&nbsp; {{$definition->level}}. &nbsp;&nbsp;&nbsp;{{ $definition->description }}</label></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endforeach
</div>
