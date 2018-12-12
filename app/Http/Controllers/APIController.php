<?php

namespace App\Http\Controllers;

use App\Hamsaa\Constants\SystemResponses;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response as IlluminateResponse;

class APIController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $message;
    protected $statusCode = 200;

    /**
     * @return int
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    //Default Response
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    //Error responses
    public function respondWithError()
    {
        return $this->respond([
            'message' => $this->getMessage()
        ]);
    }

    public function respondNotFound()
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError();
    }

    public function respondBadRequest()
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError();
    }

    public function respondUnauthorized()
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError();
    }

    public function respondConflict()
    {
        $this->setMessage(SystemResponses::PARAMETERS_HAVE_CONFLICT);
        return $this->setStatusCode(IlluminateResponse::HTTP_CONFLICT)->respondWithError();
    }

    //Successful Responses
    public function respondCreated($data = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($data);
    }

    public function respondSuccessful($data = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respond($data);
    }

    public function respondWithoutContent()
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NO_CONTENT)->respond(null);
    }

    public function user() : User
    {
        return auth()->user();
    }
}
