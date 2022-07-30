@extends('layouts.admin')

@section('title')
    Product Gallery
@endsection

@section('content')
              <!-- Section Content -->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Gallery</h2>
                <p class="dashboard-subtitle">List of Product Galleries</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('product-gallery.create') }}" class="btn btn-primary mb-3">+ Create New Gallery</a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                      <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Product Name</th>
                                          <th>Photo</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
    <script>
            // AJAX DataTable
            var t = $('#crudTable').DataTable({
              processing: true,
              serverSide: true,
              ordering: true,
                ajax: {
                    // url: "{{ route('product.index') }}"
                    url: "{!! url()->current() !!}",
                },

                columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0,
                  },
                ],
                order: [[1, 'asc']],
                
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'product.name', name: 'product.name'},
                    {data: 'photos', name: 'photos'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: 'false',
                        searchable: 'false',
                        width: '15%',
                    }
                ],
            });
          t.on('order.dt search.dt', function () {
          let i = 1;
          t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
          });
          }).draw();
        </script>
@endpush