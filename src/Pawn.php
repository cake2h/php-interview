<?php

class Pawn extends Figure {
    public function canMove($fromX, $fromY, $toX, $toY, Board $board) {
        $chars = 'abcdefgh';
        
        $xPosition = strpos($chars, $toX) - strpos($chars, $fromX);
        $yPosition = $toY - $fromY;

        $forward = $this->isBlack ? -1 : 1;

        $targetFigure = $board->getFigureAt($toX, $toY);

        if (abs($xPosition) === 1 && $yPosition === $forward) {
            return $targetFigure !== null && $targetFigure->isBlack() !== $this->isBlack;
        }

        if ($xPosition !== 0) {
            return false;
        }

        if ($yPosition === $forward) {
            return $targetFigure === null;
        }

        $startPostiton = $this->isBlack ? 7 : 2;
        if ($fromY === $startPostiton && $yPosition === 2 * $forward) {
            $middleY = $fromY + $forward;
            return $targetFigure === null && $board->getFigureAt($fromX, $middleY) === null;
        }

        return false;
    }

    public function __toString() {
        return $this->isBlack ? '♟' : '♙';
    }
}
