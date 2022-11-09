@props(['id'])

<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-3">
                    {{$slot}}
                </div>
            </div>

        </div>
    </div>
</div>
