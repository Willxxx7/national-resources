import { useState, useEffect } from 'react';
import { api } from '../api/api.js';

export const usePictureSizes = () => {
  const [pictureSizes, setPictureSizes] = useState(() => {
    const stored = window.localStorage.getItem('picture-sizes');
    if (stored) {
      try {
        return JSON.parse(stored);
      } catch {
        return [];
      }
    }
    return [];
  });

  useEffect(() => {
    if (pictureSizes.length === 0) {
      api
        .get('picture-sizes')
        .then((res) => {
          const data = res?.data?.pictureSizes || [];
          setPictureSizes(data);
          window.localStorage.setItem('picture-sizes', JSON.stringify(data));
        })
        .catch(() => {
          return [];
        });
    }
  }, [pictureSizes.length]);

  return pictureSizes;
};
