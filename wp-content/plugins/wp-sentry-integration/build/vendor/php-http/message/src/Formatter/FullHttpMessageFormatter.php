<?php

namespace WPSentry\ScopedVendor\Http\Message\Formatter;

use WPSentry\ScopedVendor\Http\Message\Formatter;
use WPSentry\ScopedVendor\Psr\Http\Message\MessageInterface;
use WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface;
use WPSentry\ScopedVendor\Psr\Http\Message\ResponseInterface;
/**
 * A formatter that prints the complete HTTP message.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class FullHttpMessageFormatter implements \WPSentry\ScopedVendor\Http\Message\Formatter
{
    /**
     * The maximum length of the body.
     *
     * @var int|null
     */
    private $maxBodyLength;
    /**
     * @var string
     */
    private $binaryDetectionRegex;
    /**
     * @param int|null $maxBodyLength
     * @param string   $binaryDetectionRegex By default, this is all non-printable ASCII characters and <DEL> except for \t, \r, \n
     */
    public function __construct($maxBodyLength = 1000, string $binaryDetectionRegex = '/([\\x00-\\x09\\x0C\\x0E-\\x1F\\x7F])/')
    {
        $this->maxBodyLength = $maxBodyLength;
        $this->binaryDetectionRegex = $binaryDetectionRegex;
    }
    /**
     * {@inheritdoc}
     */
    public function formatRequest(\WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface $request)
    {
        $message = \sprintf("%s %s HTTP/%s\n", $request->getMethod(), $request->getRequestTarget(), $request->getProtocolVersion());
        foreach ($request->getHeaders() as $name => $values) {
            $message .= $name . ': ' . \implode(', ', $values) . "\n";
        }
        return $this->addBody($request, $message);
    }
    /**
     * {@inheritdoc}
     */
    public function formatResponse(\WPSentry\ScopedVendor\Psr\Http\Message\ResponseInterface $response)
    {
        $message = \sprintf("HTTP/%s %s %s\n", $response->getProtocolVersion(), $response->getStatusCode(), $response->getReasonPhrase());
        foreach ($response->getHeaders() as $name => $values) {
            $message .= $name . ': ' . \implode(', ', $values) . "\n";
        }
        return $this->addBody($response, $message);
    }
    /**
     * Formats a response in context of its request.
     *
     * @return string
     */
    public function formatResponseForRequest(\WPSentry\ScopedVendor\Psr\Http\Message\ResponseInterface $response, \WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface $request)
    {
        return $this->formatResponse($response);
    }
    /**
     * Add the message body if the stream is seekable.
     *
     * @param string $message
     *
     * @return string
     */
    private function addBody(\WPSentry\ScopedVendor\Psr\Http\Message\MessageInterface $request, $message)
    {
        $message .= "\n";
        $stream = $request->getBody();
        if (!$stream->isSeekable() || 0 === $this->maxBodyLength) {
            // Do not read the stream
            return $message;
        }
        $data = $stream->__toString();
        $stream->rewind();
        if (\preg_match($this->binaryDetectionRegex, $data)) {
            return $message . '[binary stream omitted]';
        }
        if (null === $this->maxBodyLength) {
            return $message . $data;
        }
        return $message . \mb_substr($data, 0, $this->maxBodyLength);
    }
}
