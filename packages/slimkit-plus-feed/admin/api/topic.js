import { adminRequest } from '../utils/request-builder';

export function list(options = {}) {
  return adminRequest.get('topics', {
    validateStatus: status => status === 200,
    ...options
  });
}

export function add({ name, desc }) {
  return adminRequest.post('topics', { name, desc }, {
    validateStatus: status => status === 201
  });
}

export function update({ id, ...form }) {
  return adminRequest.put(`topics/${id}`, form, {
    validateStatus: status => status === 204
  });
}

export function hotToggle(id) {
  return adminRequest.put(`topics/${id}/hot-toggle`, {}, {
    validateStatus: status => status === 204
  });
}

export function destroy(id) {
  return adminRequest.delete(`topics/${id}`, {
    validateStatus: status => status === 204,
  });
}
