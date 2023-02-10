<?php

namespace Training\Patterns\Observer;

class Subject
{
    /**
     * @var ObserverInterface[]
     */
    protected array $observers = [];

    public function addObserver(ObserverInterface $observer): void
    {
        $this->observers[spl_object_id($observer)] = $observer;
    }

    public function removeObserver(ObserverInterface $observer): void
    {
        $id = spl_object_id($observer);
        if (array_key_exists($id, $this->observers)) {
            unset($this->observers[$id]);
        }
    }

    public function getObservers(): array
    {
        return $this->observers;
    }

    public function notifyObservers(mixed &$data): void
    {
        foreach ($this->observers as $observer) {
            $observer->getNotified($data);
        }
    }

    public function doStuff(): string
    {
        $result = "I've done stuff!";
        $this->notifyObservers($result);

        return $result;
    }
}
