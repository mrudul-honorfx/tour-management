<?php
namespace App\Http\Controllers;
use App\Models\BankDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class BankDetailsController extends Controller
{
     // TODO: create function to get bank details and return view
     public function getBankDetails()
     {
         //get all bank details
         $allBankDetails = BankDetails::all()->sortByDesc('status');
         //return view with bank details
         return view('pages.bank.bankDetails', compact('allBankDetails'));
     }
     // TODO: Create a function to add bank details
     public function addBankDetails(Request $request)
     {
         //validate the inputs
         try
         {
            $request->validate([
                'bank_name' => 'required',
                'account_name' => 'required',
                'branch' => 'required',
                'account_number' => 'required',
                'iban_number' => 'required',
            ]);
            //create a new bank details
            $bankDetails = new BankDetails();
            $bankDetails->bank_name = $request->bank_name;
            $bankDetails->account_name = $request->account_name;
            $bankDetails->branch = $request->branch;
            $bankDetails->account_number = $request->account_number;
            $bankDetails->iban_number = $request->iban_number;
            $bankDetails->status = 1;
            $bankDetails->save();
            //redirect to the bank details page
            $allBankDetails = BankDetails::all()->sortByDesc('status');
            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->addSuccess('Bank Details Added Successfully');
            return view('pages.bank.bankDetails',compact('allBankDetails'));
         }
         catch(\Exception $e)
         {
             Log::error($e->getMessage());
             flash()
             ->option('position', 'top-right')
             ->option('timeout', 3000)
             ->addSuccess('Something went wrong, Please try again later');
             return redirect()->back();
         }
     } 

     // TODO: Function to toggle bank details status
     public function toggleBankStatus(Request $request)
     {
        try
        {
            $request->validate([
                'bank_id' => 'required',
            ]);

            $bankDetails = BankDetails::find($request->bank_id);

            $bankDetails->status = !$bankDetails->status;
            $bankDetails->save();

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->addSuccess('Bank Details Status Changed Successfully');

            return 1;

        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->addSuccess('Something went wrong, Please try again later');
            return 0;
        }
     }

     public function deleteBankStatus(Request $request)
     {
        try
        {
            $request->validate([
                'bank_id' => 'required',
            ]);

            $bankDetails = BankDetails::find($request->bank_id);

            $bankDetails->delete();

            flash()
                ->option('position', 'top-right')
                ->option('timeout', 3000)
                ->addSuccess('Bank Details Deleted Successfully');

            return 1;

        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->addSuccess('Something went wrong, Please try again later');
            return 0;
        }
     }
}
