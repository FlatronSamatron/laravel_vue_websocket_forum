<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\Branch;
use App\Models\Complaint;
use App\Models\Message;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $statistics = [
                'branches' => Branch::count(),
                'themes' => Theme::count(),
                'messages' => Message::count(),
                'users' => User::count(),
        ];
        return inertia('Admin/Main/index', compact('statistics'));
    }

    public function complaints()
    {
        $complaints = ComplaintResource::collection(Complaint::all())->resolve();
        return inertia('Admin/Main/complaints', compact('complaints'));
    }

    public function updateComplaint(Complaint $complaint)
    {
        $complaint->update([
                'is_solved' => !$complaint->is_solved
        ]);
    }


}
