<div class="col-md-5 col-lg-3">
  <div class="sidebar sticky-lg-top sticky-md-top">
      <div class="sidebar-widget">
          <h3 class="mb-4">{{ $product->name ?? "" }}</h3>
          <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-8">
                  <div class="form-group">
                      <select id="inputState" class="form-control" onchange="changeLicense">
                        @foreach ($product->licenses as $license)
                          <option>{{ $license->name }}</option>
                        @endforeach
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group text-md-right text-sm-center">
                      <h2 id="price" class="item-widget-price">$28</h2>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12 border rounded my-3">
                <ul>
                  <li>1 User</li>
                  <li>2 Computer Installation</li>
                  <li>Unlimited Personal Project</li>
                  <li>5 Commercial Project</li>
                  <li>Non Logo/Logotype/Wordmark/Taglines Usage</li>
                  <li>End Product For Commercial: 1000 Prints/Sales/Pcs/Static digital images</li>
                  <li>Social Media NON-Commercial Activities</li>
                  <li>Non Website Usage</li>
                </ul>
              </div>
          </div>
          <button class="btn btn-primary btn-block" type="button">
              Purchase → <span class="price"> $77</span>
          </button>
      </div>

      <div class="sidebar-widget">
          <div class="row">
              <div class="col-12">
                  <span class="sidebar-widget-title--sm">Compatible with</span>
                  <!-- FULL COMPATIBILITY -->
                  <div class="compatibility d-flex">
                    @foreach ($product->tools as $tool)
                      <div class="col-2 p-0 text-center">
                          <img src="{{ Storage::url($tool->image) }}" alt="PS" width="#" title="{{ $tool->name }}" height="22px" />
                      </div>
                    @endforeach
                      
                  </div>
                  <hr />
                  <span class="sidebar-widget-title--sm">Features</span>
                  <ul class="list-unstyled">
                    @foreach ($product->features as $feature)
                      <li>
                          <i class="las la-check mr-2 text-success"></i>{{ $feature->name }}
                      </li>
                    @endforeach
                  </ul>
                  <hr />

                  <span class="sidebar-widget-title--sm">Compatible OS</span>
                  <ul class="list-unstyled">
                    @foreach ($product->compatibles as $compatible)
                      <li><i class="las la-check mr-2 text-success"></i>{{ $compatible->name }}</li>
                    @endforeach
                  </ul>
                  <hr />

                  <div class="col-12 p-0">
                      <div class="d-flex flex-row justify-content-between">
                          <span class="small">File size</span>
                          <strong class="small text-dark">{{ $product->file_size ?? '' }} MB</strong>
                      </div>
                      <div class="d-flex flex-row justify-content-between">
                          <span class="small">Update</span>
                          <strong class="small text-dark">{{ $product->updated_at->format("d M, Y") }}</strong>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@push("addon-script")
  <script>
    function changeLicense(){
      alert("hello")
    }
  </script>
@endpush