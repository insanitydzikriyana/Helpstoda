<?php

namespace App\Http\Controllers;

use App\Models\HelpdeskRecord;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class HelpdeskRecordController extends Controller
{
    public function dashboard(): ViewContract
    {
        return view('records.dashboard', [
            'totalRecords' => HelpdeskRecord::count(),
            'newRecords' => HelpdeskRecord::where('status', 'baru')->count(),
            'inProgressRecords' => HelpdeskRecord::where('status', 'diproses')->count(),
            'completedRecords' => HelpdeskRecord::where('status', 'selesai')->count(),
            'recentRecords' => HelpdeskRecord::latest()->take(6)->get(),
        ]);
    }

    public function index(Request $request): ViewContract
    {
        $records = HelpdeskRecord::query()
            ->when($request->filled('search'), function ($query) use ($request): void {
                $search = $request->string('search')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('ticket_number', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('records.index', compact('records'));
    }

    public function create(): ViewContract
    {
        return view('records.form', ['record' => new HelpdeskRecord, 'pageTitle' => 'Tambah data baru']);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['ticket_number'] = 'HST-'.now()->format('ymd').'-'.Str::upper(Str::random(5));

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $data['attachment_path'] = $attachment->store('helpdesk-attachments');
            $data['attachment_name'] = $attachment->getClientOriginalName();
        }

        HelpdeskRecord::create($data);

        return redirect()->route('records.index')->with('success', 'Data baru berhasil disimpan.');
    }

    public function edit(HelpdeskRecord $record): ViewContract
    {
        return view('records.form', ['record' => $record, 'pageTitle' => 'Edit data']);
    }

    public function update(Request $request, HelpdeskRecord $record): RedirectResponse
    {
        $data = $this->validatedData($request);
        $previousAttachmentPath = $record->attachment_path;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $data['attachment_path'] = $attachment->store('helpdesk-attachments');
            $data['attachment_name'] = $attachment->getClientOriginalName();
        }

        $record->update($data);

        if (isset($data['attachment_path']) && $previousAttachmentPath) {
            Storage::delete($previousAttachmentPath);
        }

        return redirect()->route('records.index')->with('success', 'Perubahan data berhasil disimpan.');
    }

    public function destroy(HelpdeskRecord $record): RedirectResponse
    {
        $attachmentPath = $record->attachment_path;
        $record->delete();

        if ($attachmentPath) {
            Storage::delete($attachmentPath);
        }

        return redirect()->route('records.index')->with('success', 'Data berhasil dihapus.');
    }

    public function downloadAttachment(HelpdeskRecord $record): StreamedResponse
    {
        abort_unless($record->attachment_path, 404);

        $downloadName = Str::ascii(basename($record->attachment_name ?? 'lampiran')) ?: 'lampiran';

        return Storage::download($record->attachment_path, $downloadName);
    }

    /** @return array{title: string, customer_name: string, email: ?string, phone: ?string, category: string, status: string, description: ?string} */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'category' => ['required', 'string', 'max:80'],
            'status' => ['required', Rule::in(['baru', 'diproses', 'selesai'])],
            'description' => ['nullable', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,csv,txt,jpg,jpeg,png,zip'],
        ], [
            'attachment.file' => 'File lampiran tidak valid.',
            'attachment.mimes' => 'Format file lampiran tidak didukung.',
        ]);

        unset($data['attachment']);

        return $data;
    }
}
