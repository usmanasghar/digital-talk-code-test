<?php

namespace DTApi\Http\Controllers;

use DTApi\Models\Job;
use DTApi\Http\Requests;
use DTApi\Models\Distance;
use Illuminate\Http\Request;
use DTApi\Repository\BookingRepository;

/**
 * Class BookingController
 * @package DTApi\Http\Controllers
 */
class BookingController extends Controller
{

    /**
     * @var BookingRepository
     */
    protected $repository;

    /**
     * BookingController constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->repository = $bookingRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */

    /**
     * there should be input form validation for form validation
     * env is defined/used often, it should be in config file for better readability.
     * define isAdmin and isSuperAdmin in model and reuse it.
     * this index block code will break bcz there is no else condition was defined
     * we can use try/catch for error handling
     * appropriete response status code
     **/
    public function index(Request $request): Response
    {
        try {
            $user_id = $request->get('user_id');
            $response = [];
            if ($user_id) {
                $response = $this->repository->getUsersJobs($user_id);
            } elseif ($request->user()->isAdmin() || $request->user()->isSuperAdmin()) {
                $response = $this->repository->getAll($request);
            }
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * define a new function findWithTranslatorAndUser in repository for better code reusability.
     *  appropriate http response status code
     *  error handling
     *  return type of function
     */
    public function show(int $id): Response
    {
        try {
            $job = $this->repository->findWithTranslatorAndUser($id);
            if ($job) {
                return response()->json(['data' => $job], 200);
            }
            return response()->json(['message' => 'Job not found'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        try {
            /** define validation rules for data */
            $data = $request->validate([

            ]);
            $response = $this->repository->store($request->user(), $data);
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param int $id
     * @param JobUpdateRequest $request
     * @return Response
     */

    /**
     * argument type and function return type definition
     * Define Form Request for form data validation
     * readable variable names
     * use request except function for filtering request data
     **/
    public function update(int $id, JobUpdateRequest $request): Response
    {
        try {
            $data = $request->except(['_token', 'submit']);
            $authenticatedUser = $request->user();
            $response = $this->repository->updateJob($id, $data, $authenticatedUser);
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }


    /**
     * @param StoreJobEmailRequest $request
     * @return Response
     */

    /**
     * clean the code
     * form validation
     */
    public function immediateJobEmail(StoreJobEmailRequest $request): Response
    {
        try {
            $data = $request->all();
            $response = $this->repository->storeJobEmail($data);
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */

    /**
     * appropriate return type of function
     **/
    public function getHistory(Request $request): Response
    {
        try {
            $user_id = $request->get('user_id');
            if ($user_id) {
                $response = $this->repository->getUsersJobsHistory($user_id, $request);
                return response()->json($response, 200);
            } else {
                return response()->json('Not found', 404);
            }
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param AcceptJobRequest $request
     * @return Response
     */
    public function acceptJob(AcceptJobRequest $request): Response
    {
        try {
            $data = $request->all();
            $authenticatedUser = $request->user();
            $response = $this->repository->acceptJob($data, $authenticatedUser);
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function acceptJobWithId(Request $request): Response
    {
        try {
            $job_id = $request->get('job_id');
            $authenticatedUser = $request->user();
            $response = $this->repository->acceptJobWithId($job_id, $authenticatedUser);
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param CancelJobRequest $request
     * @return Response
     */

    /**
     *  Form request validation
     */
    public function cancelJob(CancelJobRequest $request): Response
    {
        try {
            $data = $request->all();
            $authenticatedUser = $request->user();
            $response = $this->repository->cancelJobAjax($data, $authenticatedUser);
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param EndJobRequest $request
     * @return Response
     */
    /**form validation**/
    public function endJob(EndJobRequest $request): Response
    {
        try {
            $data = $request->all();
            $response = $this->repository->endJob($data);
            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

    }

    /**
     * @param CustomerNotCallRequest $request
     * @return Response
     */
    public function customerNotCall(CustomerNotCallRequest $request): Response
    {
        try {
            $data = $request->all();
            $response = $this->repository->customerNotCall($data);
            return response($response);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getPotentialJobs(Request $request): Response
    {

        try {
            $authenticatedUser = $request->user();
            $response = $this->repository->getPotentialJobs($authenticatedUser);
            return response($response);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }


    /**
     * @param DistanceFeedRequest $request
     * @return Response
     */
    /**
     *  FormRequest Validation
     *  Used the null colescing operator ?? for default variable values
     */
    public function distanceFeed(DistanceFeedRequest $request): Response
    {
        try {
            $data = $request->all();
            $distance = $data['distance'] ?? "";
            $time = $data['time'] ?? "";
            $jobid = $data['jobid'] ?? "";
            $session = $data['session_time'] ?? "";

            $flagged = ($data['flagged'] == 'true' && $data['admincomment'] == '') ? 'yes' : 'no';
            $manually_handled = ($data['manually_handled'] == 'true') ? 'yes' : 'no';
            $by_admin = ($data['by_admin'] == 'true') ? 'yes' : 'no';

            $admincomment = $data['admincomment'] ?? "";

            if ($time || $distance) {
                Distance::where('job_id', $jobid)->update(['distance' => $distance, 'time' => $time]);
            }

            if ($admincomment || $session || $flagged || $manually_handled || $by_admin) {
                Job::where('id', $jobid)->update([
                    'admin_comments' => $admincomment,
                    'flagged' => $flagged,
                    'session_time' => $session,
                    'manually_handled' => $manually_handled,
                    'by_admin' => $by_admin
                ]);
            }
            return response()->json('Record updated!');
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    /**
     * @param JobReopenRequest $request
     * @return Response
     */
    public function reopen(JobReopenRequest $request): Response
    {
        try {
            $data = $request->all();
            $response = $this->repository->reopen($data);
            return response()->json($response);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }


    /**
     * @param Request $request
     * @return Response
     */
    /**
     * code breakage if job not found
     */
    public function resendNotifications(Request $request): Response
    {
        try {
            $jobId = $request->input('jobid');
            $job = $this->repository->find($jobId);
            if ($job) {
                $jobData = $this->repository->jobToData($job);
                $this->repository->sendNotificationTranslator($job, $jobData, '*');
                return response(['success' => 'Push sent']);
            }
            return response(['error' => 'Job not found'], 404);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }


    /**
     * Sends SMS to Translator
     *
     * @param Request $request
     * @return Response
     */
    public function resendSMSNotifications(Request $request): Response
    {
        $jobId = $request->input('jobid');
        $job = $this->repository->find($jobId);
        if (!$job) {
            return response(['error' => 'Job not found'], 404);
        }
        try {
            $this->repository->sendSMSNotificationToTranslator($job);
            return response(['success' => 'SMS sent']);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }
    }

}
