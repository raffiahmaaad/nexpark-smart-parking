<!-- Modal -->
<div class="modal fade" id="delete{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content nexpark-delete-modal-card">
            <form action="{{ route('backend.admins.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-delete-header-custom">
                    <div class="d-flex align-items-center w-100">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <span class="modal-title font-weight-bold" id="deleteModalLabel"
                                style="font-size:1.35rem; letter-spacing:0.5px;">Konfirmasi Hapus</span>
                        </div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body text-center py-5 nexpark-delete-modal-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="icon-avatar mb-4">
                            <i class="ik ik-user-x" style="font-size:4.5rem; color:#e53935;"></i>
                        </div>
                        <h3 class="mb-2 font-weight-bold" style="color:#222; letter-spacing:0.5px;">Hapus Administrator
                        </h3>
                        <p class="mb-1" style="color:#444; font-size:1rem;">Apakah Anda yakin ingin menghapus
                            administrator :</p>
                        <div class="mb-3">
                            <span class="badge badge-pill badge-danger px-3 py-2"
                                style="font-size:1.15rem; letter-spacing:0.5px;">{{ $user->name }}</span>
                        </div>
                        <div class="alert alert-warning py-2 px-3 mb-0"
                            style="font-size:0.98rem; background:rgba(255,243,205,0.7); color:#b26a00; border:none;">
                            <i class="ik ik-alert-circle mr-1"></i>
                            Tindakan ini <span class="font-weight-bold text-danger">tidak dapat dibatalkan</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer nexpark-delete-modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 nexpark-delete-btn-cancel"
                        data-dismiss="modal">
                        <i class="ik ik-x mr-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger btn-lg px-4 nexpark-delete-btn-confirm">
                        <i class="ik ik-trash-2 mr-2"></i>Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* This section ensures no green or messy corners. */

        /* Global Overrides for Modal Containers */
        .modal.fade:not(.show) .modal-dialog {
            transform: none !important;
        }

        .modal,
        .modal-dialog {
            background: transparent !important;
        }

        /* Main Modal Card Wrapper */
        .nexpark-delete-modal-card {
            background: #fff !important;
            border: none !important;
            border-radius: 35px !important;
            /* Larger, smoother radius for card */
            box-shadow: 0 18px 70px 0 rgba(44, 62, 80, 0.3), 0 5px 15px 0 rgba(229, 57, 53, 0.2);
            /* Enhanced shadow */
            overflow: hidden !important;
            /* CRITICAL for clean corners */
            padding: 0 !important;
            position: relative !important;
        }

        /* Header Styling */
        .modal-delete-header-custom {
            /* Changed from nexpark-delete-modal-header */
            background: linear-gradient(90deg, #ff3333 0%, #ff6666 100%) !important;
            /* Brighter, more vibrant red */
            color: #fff !important;
            border-top-left-radius: 35px !important;
            /* Match card radius */
            border-top-right-radius: 35px !important;
            /* Match card radius */
            border-bottom: none !important;
            padding: 2rem 3rem 2rem 2.5rem !important;
            /* Increased padding */
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }

        /* Header Danger Icon Circle */
        .nexpark-delete-icon-circle {
            background: rgba(255, 255, 255, 0.25) !important;
            /* Prominent translucent background */
            border-radius: 50% !important;
            width: 65px !important;
            /* Larger circle */
            height: 65px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-right: 1.5rem !important;
            box-shadow: 0 4px 15px rgba(229, 51, 51, 0.25) !important;
            /* Stronger shadow */
        }

        /* Danger Icon (Triangle) inside Header Circle */
        .nexpark-delete-danger-icon {
            color: #fff !important;
            /* White icon for maximum contrast */
            font-size: 4rem !important;
            /* Much larger, prominent icon */
            filter: drop-shadow(0 3px 12px rgba(0, 0, 0, 0.3)) !important;
            /* Stronger shadow for white icon */
        }

        /* Close Button (X) Styling */
        .nexpark-delete-close-btn {
            color: #fff !important;
            /* Always white */
            opacity: 1 !important;
            font-size: 3rem !important;
            /* Larger X icon */
            font-weight: bold !important;
            border: none !important;
            background: transparent !important;
            transition: all 0.2s ease-in-out !important;
            border-radius: 50% !important;
            width: 55px !important;
            /* Larger clickable area */
            height: 55px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            outline: none !important;
        }

        .nexpark-delete-close-btn:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            /* Subtle white hover effect */
            color: #fff !important;
        }

        /* Body Styling */
        .nexpark-delete-modal-body {
            background: #fff !important;
            padding: 3.5rem 3.5rem 3rem 3.5rem !important;
            /* Increased padding */
        }

        /* Icon Avatar (User-X) in Body */
        .icon-avatar {
            background: #ffebeb;
            /* Lighter red tint */
            border-radius: 50%;
            width: 100px;
            /* Slightly larger avatar circle */
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            /* More space */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Footer Styling */
        .nexpark-delete-modal-footer {
            background: #fff !important;
            border-bottom-left-radius: 35px !important;
            border-bottom-right-radius: 35px !important;
            padding: 2rem 3.5rem 3rem 3.5rem !important;
            /* Increased padding */
            gap: 1.5rem !important;
            display: flex !important;
        }

        /* Cancel Button Styling */
        .nexpark-delete-btn-cancel {
            border-radius: 12px !important;
            /* More rounded */
            font-weight: 600 !important;
            font-size: 1.2rem !important;
            border: 2px solid #e0e0e0 !important;
            background: #fff !important;
            color: #444 !important;
            transition: all 0.2s ease-in-out !important;
            padding: 0.8rem 2.2rem !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .nexpark-delete-btn-cancel:hover {
            background: #f5f5f5 !important;
            border-color: #bdbdbd !important;
            color: #e53935 !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        /* Confirm Delete Button Styling */
        .nexpark-delete-btn-confirm {
            border-radius: 12px !important;
            font-weight: 600 !important;
            font-size: 1.2rem !important;
            box-shadow: 0 4px 15px rgba(229, 51, 51, 0.3) !important;
            background: linear-gradient(90deg, #ff3333 0%, #ff6666 100%) !important;
            border: none !important;
            color: #fff !important;
            transition: background 0.2s, box-shadow 0.2s !important;
            padding: 0.8rem 2.2rem !important;
        }

        .nexpark-delete-btn-confirm:hover {
            background: linear-gradient(90deg, #cc2a2a 0%, #d44d4d 100%) !important;
            /* Darker gradient on hover */
            color: #fff !important;
            box-shadow: 0 8px 25px rgba(229, 51, 51, 0.4) !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .nexpark-delete-modal-card {
                border-radius: 20px !important;
            }

            .nexpark-delete-modal-header {
                border-radius: 20px !important;
                padding: 1.5rem !important;
            }

            .nexpark-delete-modal-body {
                padding: 2rem 1.5rem !important;
            }

            .nexpark-delete-icon-circle {
                width: 55px !important;
                height: 55px !important;
                margin-right: 1rem !important;
            }

            .nexpark-delete-danger-icon {
                font-size: 3.5rem !important;
            }
        }
    </style>
@endpush