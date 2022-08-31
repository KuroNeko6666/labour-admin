 <!-- Logout Modal-->
 <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Hapus item ini?</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">Pilih "Hapus" jika ingin menghapus item ini</div>
         <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
             <form action="{{ $path }}/{{ $item->id }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
         </div>
     </div>
 </div>
</div>
