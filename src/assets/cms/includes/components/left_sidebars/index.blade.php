
@permission('admin_menu')
@include('includes/components/left_sidebars/admin')

@else
    @include('includes/components/left_sidebars/staff')
@endauth
