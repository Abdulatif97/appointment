<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentResource as AppointmentDto;
use App\Http\Resources\DTOCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AppointmentCreateRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Repositories\Contracts\AppointmentRepository;
use App\Services\Contracts\AppointmentService;
use App\Validators\AppointmentValidator;

/**
 * Class AppointmentsController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class AppointmentsController extends Controller
{
    /**
     * @var AppointmentRepository
     */
    protected $repository;

    /**
     * @var AppointmentValidator
     */
    protected $validator;

    /**
     * @var AppointmentService
     */
    protected $service;

    /**
     * AppointmentsController constructor.
     *
     * @param AppointmentRepository $repository
     * @param AppointmentValidator $validator
     * @param AppointmentService $service
     */
    public function __construct(
        AppointmentRepository $repository,
        AppointmentValidator $validator,
        AppointmentService $service
    ) {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }


    /**
     * Login user after all check
     * Method sms or password
     *
     * @param Request $request
     * @return array|bool|false|string
     */

    /**
     * @OA\Get (
     *     path="/api/v1/appointment",
     *     summary="Appointment List",
     *      description="Return json",
     *      security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *       description="participant",
     *       in="query",
     *       name="participant",
     *    ),
     *     @OA\Parameter(
     *       description="performer",
     *       in="query",
     *       name="performer",
     *    ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"data": {{"id": "58a16191-f843-485b-958d-c00549158b61","identifier": {{"use": "secondary","type": "RI","system": "http://some-company.uz","value": "84152","start_date": "2022-05-18 00:00:00","end_date": null,"period": {"start": "2022-05-18 00:00:00","end": null},"assigner": "SomeCompany LLC"}},"participant": {{"actor": {"reference": "Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9f2"}},{"actor": {"reference": "Patient/1bde98b0-13dd-11ed-9c13-d45d646bc9f2"}}},"status": "BOOKED","performer": {"reference": "Organization/d3880af0-13c9-11ed-907a-d45d646bc9f2"}}}}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $items = $request->participant || $request->performer
            ? $this->repository->searchByParticipantAndPerformer($request->participant,$request->performer)->get()
            : $this->repository->paginate($limit);
        $appointments = AppointmentResource::collection($items);
            //new DTOCollection($items, 'AppointmentResource');
        return response()->json($appointments);
    }


    /**
     * @OA\Post(
     *     path="/api/v1/appointment",
     *     summary="Adds a new appointment - with oneOf examples",
     *     security={{"bearer_token":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={"identifier": {{"use": "secondary","type": "RI","system": "http://some-company.uz","value": "84122","period": {"start": "2022-05-18","end": null},"assigner": "SomeCompany LLC"}},"participant": {{"actor": {"reference": "Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9f2"}},{"actor": {"reference": "Patient/1bde98b0-13dd-11ed-9c13-d45d646bc9f2"}}},"performer": {"reference": "Organization/d3880af0-13c9-11ed-907a-d45d646bc9f2"}}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(ref="#/components/schemas/Result"),
     *                 @OA\Schema(type="boolean")
     *             },
     *             @OA\Examples(example="result", value={"message": "Appointment created.","data": {"id": "59fb5975-ae82-4575-b3ca-ac26755d1523","identifier": {{"use": "secondary","type": "RI","system": "http://company.uz","value": "81122","start_date": "2022-05-18 00:00:00","end_date": null,"period": {"start": "2022-05-18 00:00:00","end": null},"assigner": "Company LLC"}},"participant": {{"actor": {"reference": "Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9s2"}},{"actor": {"reference": "Patient/1bde98b0-13dd-11ed-9c13-d45d646bc1f2"}}},"status": "BOOKED","performer": {"reference": "Organization/d3880af0-13c9-11ed-907a-d45d646bc9f2"}}}, summary="An result object."),
     *             @OA\Examples(example="bool", value=false, summary="A boolean value."),
     *         )
     *     )
     * )
     */
    public function store(AppointmentCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $appointment = $this->service->store($request->all());

            $response = [
                'message' => 'Appointment created.',
                'data'    => new AppointmentDto($appointment),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error'   => true,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @OA\Get (
     *     path="/api/v1/appointment/show/{id}",
     *     summary="Appointment show",
     *      description="Return json",
     *      security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *       description="id",
     *       in="path",
     *       name="id",
     *    ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"data": {"id": "58a16191-f843-485b-958d-c00549158b61","identifier": {{"use": "secondary","type": "RI","system": "http://some-company.uz","value": "84152","start_date": "2022-05-18 00:00:00","end_date": null,"period": {"start": "2022-05-18 00:00:00","end": null},"assigner": "SomeCompany LLC"}},"participant": {{"actor": {"reference": "Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9f2"}},{"actor": {"reference": "Patient/1bde98b0-13dd-11ed-9c13-d45d646bc9f2"}}},"status": "ARRIVED","performer": {"reference": "Organization/d3880af0-13c9-11ed-907a-d45d646bc9f2"}}}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $appointment = new AppointmentDto($this->repository->findOrFail($id));

        return response()->json([
           'data' => $appointment,
        ]);
    }


    /**
     * @OA\Patch  (
     *     path="/api/v1/appointment/change-status/{id}",
     *     summary="Appointment status change",
     *      description="Return json",
     *      security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *       description="id",
     *       in="path",
     *       name="id",
     *    ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={"status": "ARRIVED"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"message": "Appointment updated.","data": {"id": "58a16191-f843-485b-958d-c00549158b61","identifier": {{"use": "secondary","type": "RI","system": "http://some-company.uz","value": "84152","start_date": "2022-05-18 00:00:00","end_date": null,"period": {"start": "2022-05-18 00:00:00","end": null},"assigner": "SomeCompany LLC"}},"participant": {{"actor": {"reference": "Practitioner/e84abf7e-13dc-11ed-a75f-d45d646bc9f2"}},{"actor": {"reference": "Patient/1bde98b0-13dd-11ed-9c13-d45d646bc9f2"}}},"status": "ARRIVED","performer": {"reference": "Organization/d3880af0-13c9-11ed-907a-d45d646bc9f2"}}}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function changeStatus(AppointmentUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $appointment = $this->service->changeStatus($id, $request->get('status'));

            $response = [
                'message' => 'Appointment updated.',
                'data'    => new AppointmentDto($appointment),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error'   => true,
                'message' => $exception->getMessage()
            ]);
        }
    }


}
