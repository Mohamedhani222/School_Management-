<div class="modal fade" id="Delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('promotions.destroy' , 'test')}}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body ">
                    هل انت متاكد من التراجع عن كل الترقيات ؟

                    <input type="hidden" value="1" name="page_id" readonly>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تراجع عن الكل</button>
                </div>
            </form>
        </div>
    </div>
</div>
